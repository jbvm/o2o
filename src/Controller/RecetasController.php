<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\ConectorApi;
use App\Services\ConvertArray;
 

class RecetasController extends AbstractController
{
    /**
     * @Route("/recetas", name="recetas")
     */
    public function index(): Response
    {
        return $this->render('recetas/index.html.twig', [
            'controller_name' => 'RecetasController',
        ]);
    }

    public function buscar(Request $request, ConectorApi $conectorApi, $food=''): Response
    {
        if(!$food){
            $food = $request->request->get("food", null);
        }

        if(!$food){
            $urlPet = 'https://api.punkapi.com/v2/beers';
        } else {
            $urlPet = 'https://api.punkapi.com/v2/beers?food='.$food;
        }

        $content = $conectorApi->getData($urlPet);

        $response = new JsonResponse();

        if($content === false){
            return $response->setData(array(
                'success' => 'failed',
                'code' => 400,
                'data' => "Imposible conectar"
            ));
        } else {
            if(count($content) > 0){
                $keys = array('id', 'name', 'description');
                $respuesta = $convertArray->subsArray($content, $keys);
            } else {
                $respuesta = 'No hay resultados';
            }            
            
            return $response->setData(array(
                'success' => 'ok',
                'code' => 200,
                'data' => $respuesta
            ));
        }

    }

    public function getReceta(ConectorApi $conectorApi, ConvertArray $convertArray, $id): Response
    {
        $response = new JsonResponse();

        if(!$id || !is_numeric($id)){
            return $response->setData(array(
                'success' => 'failed',
                'code' => 400,
                'data' => 'Identificador no válido'
            ));
        } else {
            $urlPet = 'https://api.punkapi.com/v2/beers/'.$id;

            $content = $conectorApi->getData($urlPet);

            if($content === false){
                return $response->setData(array(
                    'success' => 'failed',
                    'code' => 400,
                    'data' => "Imposible conectar"
                ));
            }else{
                if(count($content) > 0){
                    $keys = array('id', 'name', 'description', 'image_url', 'tagline', 'first_brewed');
                    $respuesta = $convertArray->subsArray($content, $keys);
                } else {
                    $respuesta = 'No hay resultados';
                }
                
                return $response->setData(array(
                    'success' => 'ok',
                    'code' => 200,
                    'data' => $respuesta
                ));
            }
        }
    }
}
 