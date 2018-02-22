<?php

namespace App\Controller;

use App\Utils\GoogleMapsDistanceService;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Location;

class DistanceController extends Controller
{
    /**
     * @Route("/distance", name="get_distance")
     */
    public function get_distance(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Location::class);
        $locations = $repository->findAll();
        if (count($locations) > 0) {
            $marker_choices = array();
            foreach ($locations as $location) {
                $marker_choices[$location->getAddress()] = json_encode(array('latitude' => $location->getLatitude(),
                    'longitude' => $location->getLongitude()));
            }
            $defaultFormData = array();
            $form = $this->createFormBuilder($defaultFormData)
                ->add('From', ChoiceType::class, array('choices' => $marker_choices))
                ->add('To', ChoiceType::class, array('choices' => $marker_choices))
                ->add('Get Distance', SubmitType::class)
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $location1 = json_decode($form->get('From')->getData());
                $location2 = json_decode($form->get('To')->getData());
                $googleMapsDistanceService = new GoogleMapsDistanceService('AIzaSyAYvkGf5VVaavgfc0Vw2jDwtzYEaspD7TU');
                $distance = $googleMapsDistanceService->getDistance($location1->latitude, $location1->longitude,
                    $location2->latitude, $location2->longitude);
                return $this->render("distance/index.html.twig", array('form' => $form->createView(),
                    'distance' => $distance / 1000));
            }

            return $this->render("distance/index.html.twig", array('form' => $form->createView()));
        } else {
            return $this->render("distance/index.html.twig");
        }
    }
}