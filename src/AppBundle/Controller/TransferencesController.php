<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Transferences;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Transference controller.
 *
 */
class TransferencesController extends Controller
{
    /**
     * Lists all transference entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $transferences = $em->getRepository('AppBundle:Transferences')->findAll();

        return $this->render('transferences/index.html.twig', array(
            'transferences' => $transferences,
        ));
    }

    /**
     * Creates a new transference entity.
     *
     */
    public function newAction(Request $request)
    {
        $transference = new Transferences();

        $form = $this->createForm('AppBundle\Form\TransferencesType', $transference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $origin = $transference->getOrigin()->getAccount()->getId();
            $destination = $transference->getDestination()->getAccount()->getId();

            if ($origin == $destination) {
                $this->get('session')->getFlashBag()->add('advertencia', "you high? Please, avoid to transfer money to one account to the same.");
            }else{
            // Verificar que el monto es posible
            $balance_origin = $transference->getOrigin()->getAccount()->getBalance();
            $amount = $transference->getAmount();
                if ($amount <= $balance_origin) {
                    $origin_account = $transference->getOrigin()->getAccount();
                    $origin_account->setBalance($balance_origin-$amount);
                    
                    $destination_account = $transference->getDestination()->getAccount();
                    $prev_balance = $destination_account->getBalance();
                    $destination_account->setBalance($prev_balance+$amount);

                    $em->persist($origin_account);
                    $em->persist($destination_account);

                    // to ensure the correct timing to be saved
                    $transference->setDate(new \DateTime('now'));

                    $em->persist($transference);
                    $em->flush();

                    $this->get('session')->getFlashBag()->add('exito', "Transference was successfull, ".$amount." were uncount from origin account and added to destination.");
                    return $this->redirectToRoute('transferences_show', array('id' => $transference->getId()));
                }else{
                    $this->get('session')->getFlashBag()->add('advertencia', "Transference can not be made, origin account does not have enough balance to proceed.");
                }
            }
        }

        return $this->render('transferences/new.html.twig', array(
            'transference' => $transference,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a transference entity.
     *
     */
    public function showAction(Transferences $transference)
    {
        $deleteForm = $this->createDeleteForm($transference);

        return $this->render('transferences/show.html.twig', array(
            'transference' => $transference,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing transference entity.
     *
     */
    public function editAction(Request $request, Transferences $transference)
    {
        $deleteForm = $this->createDeleteForm($transference);
        $editForm = $this->createForm('AppBundle\Form\TransferencesType', $transference);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transferences_edit', array('id' => $transference->getId()));
        }

        return $this->render('transferences/edit.html.twig', array(
            'transference' => $transference,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a transference entity.
     *
     */
    public function deleteAction(Request $request, Transferences $transference)
    {
        $form = $this->createDeleteForm($transference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($transference);
            $em->flush();
        }

        return $this->redirectToRoute('transferences_index');
    }

    /**
     * Creates a form to delete a transference entity.
     *
     * @param Transferences $transference The transference entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Transferences $transference)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('transferences_delete', array('id' => $transference->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
