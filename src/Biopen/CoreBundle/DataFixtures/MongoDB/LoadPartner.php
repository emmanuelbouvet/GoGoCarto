<?php

namespace Biopen\CoreBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Biopen\CoreBundle\Document\Partner;

use joshtronic\LoremIpsum;

class LoadPartner implements FixtureInterface
{
  
  public function load(ObjectManager $manager)
  {  
    $lipsum = new LoremIpsum();  

    // $names = array('colibris','Le marché citoyen','supaéro','Alternatiba');
    // foreach ($names as $key => $name) 
    // {
    //   $new_partner = new Partner();

    //   $new_partner->setName($name); 
    //   $new_partner->setContent($lipsum->words(rand(30,100)));
    //   $new_partner->setLogoUrl("http://lorempixel.com/300/300/abstract/" . $key);
    //   $new_partner->setWebsiteUrl("www.partenaire.com");
    //   $manager->persist($new_partner);
    // }  

    $new_partner = new Partner();

    $new_partner->setName("Colibris"); 
    $new_partner->setContent("Créé en 2007 sous l’impulsion de Pierre Rabhi, Colibris se mobilise pour la construction d’une société écologique et humaine. Colibris a pour mission d’inspirer, relier et soutenir les citoyen.ne.s engagé.e.s dans une démarche de transition écologique et solidaire.
L’association cartographie depuis sa création en 2007, en partenariat avec Le Marché Citoyen, les acteurs de la transition.");
    $new_partner->setLogoUrl("colibris.png");
    $new_partner->setWebsiteUrl("colibris-lemouvement.org");
    $manager->persist($new_partner);

    $new_partner = new Partner();

    $new_partner->setName("Le Marché Citoyen"); 
    $new_partner->setContent("Référencant depuis plus de 10 ans des commerces engagés vers la transition écologique et sociale, \"Le Marché Citoyen\" fusionne avec la carte \"PrèsDeChezNous\" pour mettre sa base de données en commun!");
    $new_partner->setLogoUrl("marchecitoyen.png");
    $new_partner->setWebsiteUrl("www.lemarchecitoyen.net");
    $manager->persist($new_partner);     

    // we trigger saving of all partners
    $manager->flush();
  }
}
