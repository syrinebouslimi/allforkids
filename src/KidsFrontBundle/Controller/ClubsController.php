<?php

namespace KidsFrontBundle\Controller;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Marker;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderAddressRequest;
use Ivory\GoogleMap\Service\Geocoder\Request\GeocoderPlaceIdRequest;
use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ClubsController extends Controller
{


    public function afficheclubsfrontAction ()

    {
        $clu=$this->getDoctrine()->getRepository('UserBundle:Club')->findAll();




        return $this->render ( '@KidsFront/afficheclubsfront.html.twig',array('form'=>$clu));

    }


    public function mapAction(Request $request)
    {
        $id=$request->get('id');
        $club = $this->getDoctrine()->getRepository('UserBundle:Club')->findOneBy(array('id'=>$id));

        $coor=new Coordinate($club->getLat(),$club->getLong());

        $marker = new Marker($coor);
        $marker->setOption('draggable',true);
        $map = new Map();
        $map->getOverlayManager()->addMarker($marker);
        $coor=$marker->getPosition();

        $map->setMapOption('zoom',15);
        $map->setCenter($coor);

        return $this->render('@KidsFront/AfficherMap.html.twig',array("map"=>$map,"club"=>$club));
    }





}
