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
use App\Form\AddressForm;
use App\Entity\Location;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $location = new Location();

        $form = $this->createForm(AddressForm::class, $location);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $google_maps_geocode = new GoogleMapsGeocode('AIzaSyAmyYNlxuCGvftIhFlKACAqwRbBPDqtySI');
            $location = $form->getData();
            $location = $google_maps_geocode->getLatLng($location->getAddress());
            $form = $this->createForm(AddressForm::class, $location);
            $cookies = $request->cookies;
            $data = array('latitude' => $location->getLatitude(), 'longitude' => $location->getLongitude(), 'address' => $location->getAddress());
            if ($cookies->has('locations')) {
                $locations = json_decode($cookies->get('locations'));
                array_push($locations, $data);
            } else {
                $locations = [];
                array_push($locations, $data);
            }
            $response = $this->render("home/index.html.twig", array('form' => $form->createView(), 'locations' => $locations));
            $response->headers->setCookie(new Cookie('locations', json_encode($locations)));
            return $response;
        }

        $cookies = $request->cookies;
        if ($cookies->has('locations')) {
            $locations = json_decode($cookies->get('locations'));
            return $this->render("home/index.html.twig", array('form' => $form->createView(), 'locations' => $locations));
        } else {
            return $this->render("home/index.html.twig", array('form' => $form->createView()));
        }
    }
}
