<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Hebergement;
use App\Entity\User;
use App\Entity\Mairie;

class PdfController extends Controller
{
    /**
     * @Route("/pdf", name="pdf")
     */
    public function index()
    {
        return $this->render('pdf/index.html.twig', [
            'controller_name' => 'PdfController',
        ]);
    }
    
    /**
     * @Route("/admin/hebergement/show/{id}/pdf", name="load_pdf")
     */
    public function loadPdf(Hebergement $hebergement)
    {
        $pdf = new \FPDF('P','mm','A4');
        
        $user = $this->getUser();
        
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);
        $repoUser = $this->getDoctrine()->getRepository(User::class);
        
        dump($user);
        $hebergement->setHebStatut('validée');
 
        // ************************* PAGE 1
$pdf->AddPage();
$pdf->SetAutoPageBreak(0);
$pdf->SetFont('Times','',10, 'cp1252');

$pdf->Image('assets/img/cerfapdf/logo.png',90,0,26);
$pdf->Cell(185,50,utf8_decode('DIRECTION GÉNÉRALE DES ENTREPRISES'),0,1,'C');

$pdf->SetX(10);
$pdf->Image('assets/img/cerfapdf/logo-cerfa.png',10,40,20);
$pdf->Cell(10,-15,utf8_decode('N° 14004*03'));

$pdf->SetFont('Times','B',14, 'cp1252');
$pdf->Cell(165,10,utf8_decode('DÉCLARATION EN MAIRIE DES MEUBLÉS DE TOURISME'),0,1,'C');

$pdf->SetFont('Times','',14, 'cp1252');
$pdf->Cell(0,5,utf8_decode('La loi vous oblige à remplir ce formulaire et à l\'adresser au maire de la commune de l\'habitation'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('concernée en application des articles L. 324-1-1 I et D. 324-1-1 du code du tourisme¹.'),0,1,'L');

$pdf->SetFont('Times','B',14, 'cp1252');
$pdf->Cell(175,20,utf8_decode('A - IDENTIFICATION DU DÉCLARANT²'),0,1,'C');
$pdf->SetFont('Times','',14, 'cp1252');
$pdf->SetY(95);

$pdf->Cell(0,10,utf8_decode('NOM: {{userDeclarant.usernom }}'),0,0,'L');
$pdf->SetY(105);

$pdf->Cell(0,10,utf8_decode('PRENOM: '),0,0,'L');

$pdf->SetY(115);
$pdf->Cell(0,10,utf8_decode('LE CAS ÉCHÉANT, LE NOM DE LA PERSONNE MORALE:'),0,1,'L');
$pdf->Cell(0,10,utf8_decode('texte ici'),0,1,'L');
$pdf->Cell(0,10,utf8_decode('LE NUMÉRO D\'IDENTIFICATION (SIRET, SIREN):'),0,1,'L');
$pdf->Cell(0,10,utf8_decode('texte ici'),0,1,'L');

$pdf->SetY(155);
$pdf->MultiCell(0,7,utf8_decode('ADRESSE: '),0,'L', 0);

$pdf->Cell(0,10,utf8_decode('CODE POSTAL:'),0,0,'L');
$pdf->SetX(46);
$pdf->Cell(0,10,utf8_decode('cp ici'),0,1,'L');

$pdf->Cell(0,10,utf8_decode('COMMUNE:'),0,0,'L');
$pdf->SetX(40);
$pdf->Cell(0,10,utf8_decode('commune ici'),0,1,'L');

$pdf->Cell(0,10,utf8_decode('PAYS:'),0,0,'L');
$pdf->SetX(30);
$pdf->Cell(0,10,utf8_decode('pays ici'),0,1,'L');

$pdf->Cell(0,10,utf8_decode('N°TELEPHONE:'),0,0,'L');
$pdf->SetX(50);
$pdf->Cell(0,10,utf8_decode('téléphone ici'),0,1,'L');

$pdf->SetY(225);

$pdf->SetFont('Times','',11, 'cp1252');
$pdf->Cell(0,5,utf8_decode('¹ Art. L. 324-1-1 : « Toute personne qui offre à la location un meublé de tourisme, que celui-ci soit classé ou non au'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('sens du présent code, doit en avoir préalablement fait la déclaration auprès du maire de la commune où est situé le'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('meublé. Cette déclaration n\'est pas obligatoire lorsque le local à usage d\'habitation constitue la résidence principale du'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('loueur, au sens de l\'article 2 de la loi n° 89-462 du 6 juillet 1989 tendant à améliorer les rapports locatifs et portant'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('modification de la loi n° 86-1290 du 23 décembre 1986. »'),0,1,'L');

$pdf->SetY(255);
$pdf->Cell(0,5,utf8_decode('² La loi n°78-17 du 6 janvier 1978 relative à l\'informatique, aux fichiers et aux libertés s\'applique aux réponses faites à'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('ce formulaire. Elle garantit un droit d\'accès et de rectification pour ces données auprès du secrétariat de la mairie du'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('lieu où la déclaration a été effectuée. Les données recueillies sont susceptibles de faire l\'objet d\'un traitement pour le'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('compte de la commune du lieu de déclaration aux fins d\'établir une liste des meublés de tourisme pour l\'information du'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('public conformément aux dispositions de l\'article D. 324-1-1 du code du tourisme.'),0,1,'L');

// *********************** PAGE 2

$pdf->AddPage();
$pdf->SetY(10);
$pdf->SetFont('Times','',14, 'cp1252');
$pdf->Cell(0,10,utf8_decode('COURRIEL:'),0,1,'L');
$pdf->Cell(0,10,utf8_decode('email ici'),0,1,'L');
$pdf->MultiCell(0,7,utf8_decode('ADRESSE DU MEUBLÉ DE TOURISME: '),0,'L', 0);
$pdf->Cell(0,10,utf8_decode('CODE POSTAL:'),0,0,'L');
$pdf->SetX(46);
$pdf->Cell(0,10,utf8_decode('cp ici'),0,1,'L');

$pdf->Cell(0,10,utf8_decode('COMMUNE:'),0,0,'L');
$pdf->SetX(40);
$pdf->Cell(0,10,utf8_decode('commune ici'),0,1,'L');

$pdf->SetFont('Times','B',14, 'cp1252');
$pdf->Cell(175,20,utf8_decode('B - IDENTIFICATION DU MEUBLÉ DE TOURISME'),0,1,'C');

$pdf->SetFont('Times','',14, 'cp1252');
$pdf->Cell(0,10,utf8_decode('NOMBRE DE PIÈCES COMPOSANT LE MEUBLÉ:'),0,1,'L');
$pdf->Cell(0,10,utf8_decode($hebergement->getHebNbrPieces() . ' pièces'),0,1,'L');
$pdf->Cell(0,10,utf8_decode('NOMBRE MAXIMAL DE LITS (soit nombre de personnes susceptibles d\'être accueillies dans'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('le meublé): ' . $hebergement->getHebCouchagesMax() . ' couchages'),0,1,'L');

$pdf->SetY(130);
$pdf->SetFont('Times','',13, 'cp1252');
$pdf->Cell(0,10,utf8_decode('Facultatif:'),0,0,'L');
$pdf->SetX(40);
$pdf->Cell(0,10,utf8_decode('MAISON INDIVIDUELLE'),0,0,'L');
$pdf->SetX(105);
$pdf->Cell(0,10,utf8_decode('APPARTEMENT N° :'),0,0,'L');
$pdf->SetX(165);
$pdf->Cell(0,10,utf8_decode('ETAGE N° :'),0,1,'L');

$pdf->SetY(145);
$pdf->Cell(0,10,utf8_decode('LE CAS ÉCHÉANT, date de la décision de classement du meublé de tourisme ou de sa labellisation :'),0,1,'L');
$pdf->Cell(0,10,utf8_decode('Niveau de classement (nombre d\'étoiles et/ou niveau de qualité attesté par le label) :'),0,1,'L');

$pdf->SetFont('Times','B',14, 'cp1252');
$pdf->Cell(175,20,utf8_decode('C - PÉRIODES PRÉVISIONNELLES DE LOCATION'),0,1,'C');

$pdf->SetFont('Times','',14, 'cp1252');
$pdf->Cell(0,10,utf8_decode('TOUTE L\'ANNÉE'),0,0,'L');
$pdf->SetY(200);
$pdf->Cell(0,10,utf8_decode('SI NON, PRÉCISER LA OU LES PÉRIODES PRÉVISIONNELLES DE LOCATION:'),0,1,'L');
$pdf->Cell(0,10,
'periodes loc'


,0,1,'L');

$pdf->SetY(220);
$pdf->Cell(0,10,utf8_decode('FAIT A'),0,0,'L');
$pdf->SetX(90);
$pdf->Cell(0,10,utf8_decode('LE'),0,0,'L');

$pdf->SetY(240);
$pdf->Cell(0,10,utf8_decode('SIGNATURE'),0,0,'L');

$pdf->SetY(265);
$pdf->SetFont('Times','',13, 'cp1252');
$pdf->Cell(0,5,utf8_decode('Avertissement :'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('Tout changement concernant les informations fournies ci-dessus devra faire l\'objet d\'une nouvelle'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('déclaration en mairie.'),0,1,'L');

// *********************** PAGE 3

$pdf->AddPage();
$pdf->SetY(15);
$pdf->SetFont('Times','',14, 'cp1252');
$pdf->Cell(0,10,utf8_decode('CERFA N° 14004*03'),0,1,'L');
$pdf->Cell(175,20,utf8_decode('RÉPUBLIQUE FRANÇAISE'),0,1,'C');
$pdf->Cell(0,10,utf8_decode('MAIRIE de'),0,0,'L');
$pdf->SetX(45);
$pdf->Cell(0,10,utf8_decode('ville mairie ici'),0,1,'L');
$pdf->Cell(0,20,utf8_decode('Récépissé de déclaration en mairie de location de meublé de tourisme'),0,1,'L');

$pdf->SetFont('Times','',13, 'cp1252');
$pdf->Cell(0,5,utf8_decode('Il est donné récépissé de la déclaration en mairie de mise en location d\'un meublé de tourisme pour un'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('accueil maximal de'),0,0,'L');
$pdf->SetX(55);
$pdf->Cell(0,5,utf8_decode(''),0,0,'L');
$pdf->SetX(65);
$pdf->Cell(0,5,utf8_decode('personnes situé à :'),0,0,'L');

$pdf->SetY(95);
$pdf->Cell(0,5,utf8_decode('Adresse:'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('adresse ici'),0,1,'L');
$pdf->SetY(110);
$pdf->Cell(0,10,utf8_decode('Code postal:'),0,0,'L');
$pdf->SetX(45);
$pdf->Cell(0,10,utf8_decode('[cp ici]'),0,0,'L');
$pdf->SetX(75);
$pdf->Cell(0,10,utf8_decode('Commune:'),0,0,'L');
$pdf->SetX(100);
$pdf->Cell(0,10,utf8_decode('[ville ici]'),0,1,'L');

$pdf->SetY(125);
$pdf->Cell(0,10,utf8_decode('NOM, PRENOM du déclarant:'),0,0,'L');
$pdf->SetX(75);
$pdf->Cell(0,10,utf8_decode('[nom prenom ici]'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('Adresse:'),0,1,'L');
$pdf->Cell(0,5,utf8_decode('[adresse ici]'),0,1,'L');
$pdf->SetY(150);
$pdf->Cell(0,10,utf8_decode('Code postal:'),0,0,'L');
$pdf->SetX(45);
$pdf->Cell(0,10,utf8_decode('[cp ici]'),0,0,'L');
$pdf->SetX(75);
$pdf->Cell(0,10,utf8_decode('Commune:'),0,0,'L');
$pdf->SetX(100);
$pdf->Cell(0,10,utf8_decode('[villle ici]'),0,1,'L');
$pdf->Cell(0,10,utf8_decode('Pays'),0,0,'L');
$pdf->SetX(30);
$pdf->Cell(0,10,utf8_decode('[pays ici]'),0,1,'L');
$pdf->Cell(0,10,utf8_decode('Courriel:'),0,0,'L');
$pdf->SetX(35);
$pdf->Cell(0,10,utf8_decode('[mail ici]'),0,1,'L');

$pdf->SetY(190);
$pdf->Cell(0,10,utf8_decode('Fait à'),0,0,'L');
$pdf->SetX(85);
$pdf->Cell(0,10,utf8_decode(', le'),0,0,'L');

$pdf->SetY(215);
$pdf->Cell(0,10,utf8_decode('Cachet de la mairie'),0,1,'L');
$pdf->SetX(30);
$pdf->Cell(0,10,utf8_decode('[cachet ici]'),0,0,'L');


        
       return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
    }
}