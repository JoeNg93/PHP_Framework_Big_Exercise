<?php

namespace App\Controller;

use App\Utils\GoogleMapsDirectionService;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Location;

class DirectionController extends Controller
{
    /**
     * @Route("/direction", name="get_direction")
     */
    public function get_direction(Request $request)
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
                ->add('Get Direction', SubmitType::class)
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $location1 = json_decode($form->get('From')->getData());
                $location2 = json_decode($form->get('To')->getData());
                $googleMapsDistanceService = new GoogleMapsDirectionService('AIzaSyAxx5iOJxd6LRQutCIJwOg4pdqmLqy3LVg');
                $direction = $googleMapsDistanceService->getDirection($location1->latitude, $location1->longitude,
                    $location2->latitude, $location2->longitude);
                return $this->render("direction/index.html.twig", array(
                    'form' => $form->createView(),
                    'estimatedDistance' => $direction->routes[0]->legs[0]->distance->text,
                    'estimatedTime' => $direction->routes[0]->legs[0]->duration->text,
                    'directions' => $direction->routes[0]->legs[0]->steps,
                    'startLocation' => $direction->routes[0]->legs[0]->start_location,
                    'endLocation' => $direction->routes[0]->legs[0]->end_location
                ));
            }

            return $this->render("direction/index.html.twig", array('form' => $form->createView()));
        } else {
            return $this->render("direction/index.html.twig");
        }
    }
}
