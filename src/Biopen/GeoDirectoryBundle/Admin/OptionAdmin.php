<?php
/**
 * @Author: Sebastian Castro
 * @Date:   2017-03-28 15:29:03
 * @Last Modified by:   Sebastian Castro
 * @Last Modified time: 2018-01-06 14:38:58
 */
namespace Biopen\GeoDirectoryBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Biopen\GeoDirectoryBundle\Document\CategoryStatus;
use Biopen\GeoDirectoryBundle\Document\ModerationState;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface;

class OptionAdmin extends AbstractAdmin
{
   protected $baseRouteName = 'admin_biopen_geodirectory_option';
	protected $baseRoutePattern = 'admin_biopen_geodirectory_option';

   public function createQuery($context = 'list')
	{
	    $query = parent::createQuery($context);
	    return $query;
	}

	protected function configureFormFields(FormMapper $formMapper)
	{
	  $formMapper
	  ->with('Paramètres principaux', array('class' => 'col-xs-12 col-md-6'))
		  	->add('name', null, array('required' => true, 'label' => 'Nom'))
		  	// ->add('optionValues', null, array('template' => 'BiopenGeoDirectoryBundle:admin:list_option_values.html.twig'))
		  	->add('nameShort', null, array('required' => false, 'label' => 'Nom (version courte)'))
		  	->add('index', null, array('required' => true, 'label' => 'Position (pour classer les options)'))
		    ->add('parent', 'sonata_type_model', array(
            'class'=> 'Biopen\GeoDirectoryBundle\Document\Category', 
            'required' => false, 
            'choices_as_values' => true,
            'label' => 'Catégorie parente', 
            'mapped' => true), array('admin_code' => 'admin.category.lite'))
		  	->add('color', 'xmon_color_picker', array('required' => false, 'label' => 'Couleur'))			  	
		  	->add('icon', null, array('required' => false, 'label' => 'Icone'))			  	
		  	->add('useIconForMarker', null, array('required' => false, 'label' => "Utiliser l'icone de l'option pour le marqueur"))		
		  	->add('useColorForMarker', null, array('required' => false, 'label' => "Utiliser la couleur de l'option pour le marqueur"))		  	
		->end()
		->with('Paramètres secondaires', array('class' => 'col-xs-12 col-md-6'))	
			->add('softColor', 'xmon_color_picker', array('required' => false, 'label' => 'Couleur adoucie'))	
			->add('textHelper', null, array('required' => false, 'label' => "Message d'aide pour décrire rapidement l'option"))		  
			->add('displayOption', null, array('required' => false, 'label' => "Activer l'option"))	
		  	->add('showExpanded', null, array('required' => false, 'label' => 'En position intiale afficher les sous catégories de cette option'))							
		->end()  
		->with('Sous catégories', array('class' => 'col-xs-12'))	
			->add('subcategories', 'sonata_type_collection', array('by_reference' => false, 'type_options' => array('delete' => true)), 
				 array(
                'edit' => 'inline',
                'inline' => 'table',
                'admin_code' => 'admin.category.lite',
                //'sortable' => 'index',
            ))
		->end();          
	}

	protected function configureListFields(ListMapper $listMapper)
	{
	  $listMapper
	      ->addIdentifier('name')	 
	      ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                    'move' => array(
                        'template' => 'PixSortableBehaviorBundle:Default:_sort.html.twig'
                    )
                )
            ));   
	}

	protected function configureRoutes(RouteCollection $collection)
	{
	    $collection->add('move', $this->getRouterIdParameter().'/move/{position}');
	}
}