<?php
namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\HebergementRepository;
use App\Entity\Hebergement;
use App\Form\HebergementType;
use App\Form\HebergementEditType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class PublicListingController extends Controller
{
    /**
     * @Route("/commune/listing", name="commune_listing")
     */
    public function index(HebergementRepository $hebergementRepository) : Response
    {
        
    // dump($commune);
    // $commune = null;
    
    // dump($commune);
    
    // if($commune == null){
    // //     return $this->redirectToRoute('declarer');
    // }
        return $this->render('public_listing/index.html.twig', ['hebergements' => $hebergementRepository->findBy(['heb_commune' => 'Barcelonnette'],['heb_date_creation' => 'DESC'])
        ]);
    }
}