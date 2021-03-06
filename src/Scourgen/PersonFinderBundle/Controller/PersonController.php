<?php

namespace Scourgen\PersonFinderBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Scourgen\PersonFinderBundle\Entity\Person;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//use Scourgen\PersonFinderBundle\Form\PersonType;
use Scourgen\PersonFinderBundle\Entity\Note;

class PersonController extends Controller
{
    /**
     * @Route("/post_new_person",name="post_new_person")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $person = new Person();
        $form = $this->createFormBuilder($person)
            ->add('fullname', TextType::class)
            ->add('description', TextType::class)
            ->getForm();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $person->setSourceDate(new \DateTime('now',new \DateTimeZone('UTC')));
                $em = $this->getDoctrine()->getManager();
                $em->persist($person);
                $em->flush();
            }
        } else {
        }
        return array('form' => $form->createView());
    }
    /**
     * @Route("/person/{person_id}",name="person_detail")
     * @Template()
     */
    public function personDetailAction($person_id)
    {
        $odm = $this->getDoctrine()->getManager();
        $person=$odm->getRepository('ScourgenPersonFinderBundle:Person')->find($person_id);
        $note = new Note();
        $form = $this->createFormBuilder($note)
            ->add('author_name', TextType::class)
            ->add('text', TextType::class)
            ->getForm();
        return array('person'=>$person,'form'=>$form->createView());
    }
}

///**
// * Person controller.
// *
// * @Route("/person")
// */
//class PersonController extends Controller
//{
//    /**
//     * Lists all Person entities.
//     *
//     * @Route("/", name="person_index")
//     * @Method("GET")
//     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $people = $em->getRepository('ScourgenPersonFinderBundle:Person')->findAll();
//
//        return $this->render('person/index.html.twig', array(
//            'people' => $people,
//        ));
//    }
//
//    /**
//     * Creates a new Person entity.
//     *
//     * @Route("/new", name="person_new")
//     * @Method({"GET", "POST"})
//     */
//    public function newAction(Request $request)
//    {
//        $person = new Person();
//        $form = $this->createForm('Scourgen\PersonFinderBundle\Form\PersonType', $person);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($person);
//            $em->flush();
//
//            return $this->redirectToRoute('person_show', array('id' => $person->getId()));
//        }
//
//        return $this->render('person/new.html.twig', array(
//            'person' => $person,
//            'form' => $form->createView(),
//        ));
//    }
//
//    /**
//     * Finds and displays a Person entity.
//     *
//     * @Route("/{id}", name="person_show")
//     * @Method("GET")
//     */
//    public function showAction(Person $person)
//    {
//        $deleteForm = $this->createDeleteForm($person);
//
//        return $this->render('person/show.html.twig', array(
//            'person' => $person,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Displays a form to edit an existing Person entity.
//     *
//     * @Route("/{id}/edit", name="person_edit")
//     * @Method({"GET", "POST"})
//     */
//    public function editAction(Request $request, Person $person)
//    {
//        $deleteForm = $this->createDeleteForm($person);
//        $editForm = $this->createForm('Scourgen\PersonFinderBundle\Form\PersonType', $person);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($person);
//            $em->flush();
//
//            return $this->redirectToRoute('person_edit', array('id' => $person->getId()));
//        }
//
//        return $this->render('person/edit.html.twig', array(
//            'person' => $person,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Deletes a Person entity.
//     *
//     * @Route("/{id}", name="person_delete")
//     * @Method("DELETE")
//     */
//    public function deleteAction(Request $request, Person $person)
//    {
//        $form = $this->createDeleteForm($person);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($person);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('person_index');
//    }
//
//    /**
//     * Creates a form to delete a Person entity.
//     *
//     * @param Person $person The Person entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm(Person $person)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('person_delete', array('id' => $person->getId())))
//            ->setMethod('DELETE')
//            ->getForm()
//        ;
//    }
//}
