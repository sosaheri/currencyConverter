<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Convert;
use App\Service\ConvertService;

/**
 * @Route("/api", name="api_")
 */
class ConvertController extends AbstractController
{

    /**
     * @Route("/convert", name="convert_index", methods={"GET"})
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $converts = $doctrine
            ->getRepository(Convert::class)
            ->findAll();
 
        $data = [];
 
        foreach ($converts as $convert) {
           $data[] = [
               'id' => $convert->getId(),
               'amount' => $convert->getAmount(),
               'fromCurrency' => $convert->getFromCurrency(),
               'toCurrency' => $convert->getToCurrency(),
               'convertionAmount' => $convert->getConvertionAmount(),
               'createdAt' => $convert->getCreatedAt(),

           ];
        }
 
 
        return $this->json($data);
    }
 
    /**
     * @Route("/convert", name="convert_new", methods={"POST"})
     */
    public function new(Request $request, ManagerRegistry $doctrine, ConvertService $convertService): Response
    {
        $entityManager = $doctrine->getManager();

        $datos = $convertService->convertCurrency( 50, "USD",);

        for ($i=0; $i < count($datos); $i++) { 

                $convert = new Convert();
                $convert->setAmount( $datos[$i]['amount']);
                $convert->setFromCurrency( $datos[$i]['fromCurrency']);
                $convert->setToCurrency( $datos[$i]['toCurrency']);
                $convert->setConvertionAmount( $datos[$i]['convertionAmount'] );
                $convert->setCreatedAt( new \DateTimeImmutable() );
        
                $entityManager->persist($convert);
                $entityManager->flush();
        }
        
        return $this->json(['status' => 'Data Stored!'], Response::HTTP_CREATED );
    }

}
