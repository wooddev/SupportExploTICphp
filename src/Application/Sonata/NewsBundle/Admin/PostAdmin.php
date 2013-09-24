<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\NewsBundle\Admin;

use Sonata\NewsBundle\Admin\PostAdmin as BasePostAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PostAdmin extends BasePostAdmin
{

    protected $securityContext;   
    
    public function getSecurityContext() {
        return $this->securityContext;
    }

        public function setSecurityContext(\Symfony\Component\Security\Core\SecurityContext $securityContext) {
        $this->securityContext = $securityContext;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('author')
            ->add('enabled')
            ->add('title')
            ->add('abstract')
            ->add('content', null, array('safe' => true))
            ->add('tags')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $commentClass = $this->commentManager->getClass();
//        var_dump($this->securityContext);die;
        $currentUser = $this->getSecurityContext()->getToken()->getUser();
        $formMapper
            ->with('General')
                ->add('enabled', null, array('required' => false))
                ->add('author', 'sonata_type_model',array(
                        'preferred_choices'=>array($currentUser->getId()=>$currentUser->getUsername()),
                        )
                    )
                ->add('category', 'sonata_type_model', array('required' => false))
                ->add('title')
                ->add('content', 'sonata_formatter_type', array(
                    'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
                    'format_field'   => 'contentFormatter',
                    'source_field'   => 'rawContent',
                    'source_field_options'      => array(
                        'attr' => array('class' => 'span10', 'rows' => 20)
                    ),
                    'target_field'   => 'content',
                    'listener'       => true,
                ))
            ->end()
            ->with('Tags')
                ->add('tags', 'sonata_type_model', array(
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
                ))
            ->end();
        if($this->securityContext->isGranted('ROLE_ADMIN')){
            $formMapper
                ->with('Options')
                    ->add('publicationDateStart')
                    ->add('commentsCloseAt')
                    ->add('commentsEnabled', null, array('required' => false))
                    ->add('commentsDefaultStatus', 'choice', array('choices' => $commentClass::getStatusList(), 'expanded' => true))
                ->end()
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('author')
            ->add('category')
            ->add('enabled', null, array('editable' => true))
            ->add('tags')
            ->add('commentsEnabled', null, array('editable' => true))
            ->add('commentsCount')
            ->add('publicationDateStart')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $that = $this;

        $datagridMapper
            ->add('title')
            ->add('enabled')
            ->add('tags', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
            ->add('author')
            ->add('with_open_comments', 'doctrine_orm_callback', array(
//                'callback'   => array($this, 'getWithOpenCommentFilter'),
                'callback' => function ($queryBuilder, $alias, $field, $data) use ($that) {
                    if (!is_array($data) || !$data['value']) {
                        return;
                    }

                    $commentClass = $that->commentManager->getClass();

                    $queryBuilder->leftJoin(sprintf('%s.comments', $alias), 'c');
                    $queryBuilder->andWhere('c.status = :status');
                    $queryBuilder->setParameter('status', $commentClass::STATUS_MODERATE);
                },
                'field_type' => 'checkbox'
            ))
        ;
    }

}

?>