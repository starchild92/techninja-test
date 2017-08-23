<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DebitCard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Debitcard controller.
 *
 */
class DebitCardController extends Controller
{
    /**
     * Lists all debitCard entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $debitCards = $em->getRepository('AppBundle:DebitCard')->findAll();

        return $this->render('debitcard/index.html.twig', array(
            'debitCards' => $debitCards,
        ));
    }

    /**
     * Creates a new debitCard entity.
     *
     */
    public function newAction(Request $request)
    {
        $debitCard = new Debitcard();
        $fecha = new \DateTime('now');
        $cad = md5($fecha->format('d-M-Y H:s:i'));
        $cad = substr($cad, 0, 20);
        $debitCard->setCardno($cad);

        $form = $this->createForm('AppBundle\Form\DebitCardType', $debitCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $owner = $debitCard->getOwnedby();
            $debitCard->setBank($owner->getBank());
            $debitCard->setAccount($owner->getAccount());
            
            $em->persist($debitCard);
            $em->flush();

            return $this->redirectToRoute('debitcard_show', array('id' => $debitCard->getId()));
        }

        return $this->render('debitcard/new.html.twig', array(
            'debitCard' => $debitCard,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a debitCard entity.
     *
     */
    public function showAction(DebitCard $debitCard)
    {
        $deleteForm = $this->createDeleteForm($debitCard);

        return $this->render('debitcard/show.html.twig', array(
            'debitCard' => $debitCard,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing debitCard entity.
     *
     */
    public function editAction(Request $request, DebitCard $debitCard)
    {
        $deleteForm = $this->createDeleteForm($debitCard);
        $editForm = $this->createForm('AppBundle\Form\DebitCardType', $debitCard);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('debitcard_edit', array('id' => $debitCard->getId()));
        }

        return $this->render('debitcard/edit.html.twig', array(
            'debitCard' => $debitCard,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a debitCard entity.
     *
     */
    public function deleteAction(Request $request, DebitCard $debitCard)
    {
        $form = $this->createDeleteForm($debitCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($debitCard);
            $em->flush();
        }

        return $this->redirectToRoute('debitcard_index');
    }

    /**
     * Creates a form to delete a debitCard entity.
     *
     * @param DebitCard $debitCard The debitCard entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DebitCard $debitCard)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('debitcard_delete', array('id' => $debitCard->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
