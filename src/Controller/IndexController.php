<?php
/**
 * Created by PhpStorm.
 * User: joenguyen
 * Date: 2/5/18
 * Time: 8:45 AM
 */

namespace App\Controller;

use App\Utils\GoogleMapsGeocode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AddMarkerForm;
use App\Entity\Location;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $location = new Location();

        $form = $this->createForm(AddMarkerForm::class, $location);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $google_maps_geocode = new GoogleMapsGeocode('AIzaSyAmyYNlxuCGvftIhFlKACAqwRbBPDqtySI');
            $location = $google_maps_geocode->getLatLng($location->getAddress());
            $location->setMarkerColor($form->getData()->getMarkerColor());
            $location->setMarkerType($form->getData()->getMarkerType());
            $location->setInfo($form->getData()->getInfo());
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();
        }

        $repository = $this->getDoctrine()->getRepository(Location::class);
        $locations = $repository->findAll();

        return $this->render('home/index.html.twig', array('form' => $form->createView(), 'locations' => $locations));
    }
}
