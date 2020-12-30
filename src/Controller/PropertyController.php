<?php
namespace App\Controller;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *
 */
class PropertyController extends AbstractController
{
  public function __construct(PropertyRepository $repository, ManagerRegistry $em)
  {
    $this->repository = $repository;
    $this->em = $em;
  }

  /**
   * @Route("/biens", name="property.index")
   * @return Response
   */
  public function index(): Response
  {
    //on cree une instance de l'entity
    //$property = new Property();
    //on set ses valeurs
    /*
    $property->setTitle('Mon premier bien')
      ->setPrice(200000)
      ->setRooms(4)
      ->setBedrooms(3)
      ->setDescription('Une petite description')
      ->setSurface(60)
      ->setFloor(4)
      ->setHeat(1)
      ->setCity('Abidjan')
      ->setAddress('Attoban Lauriers 3')
      ->setPostalCode('00225');
    */
    //on envoie à la bdd
    /*
    $em = $this->getDoctrine()->getManager();
    $em->persist($property);
    $em->flush();
    */

    $property = $this->repository->findAllVisible();

    /*
    $property[0]->setSold(true);
    $this->em->flush();
    */

    return $this->render('property/index.html.twig', [
      'current_menu' => 'properties'
    ]);
  }


  /**
   * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
   * @param Property $property
   * @param string $slug
   * @return Response
   */
  public function show(Property $property, string $slug ): Response
  {
    if ($property->getSlug() !== $slug) {
      return $this->redirectToRoute('property.show', [
          'id' => $property->getId(),
          'slug' => $property->getSlug()
      ], 301);
    }
    return $this->render('property/show.html.twig', [
        'current_menu' => 'properties',
        'property' => $property
    ]);
  }

}



 ?>
