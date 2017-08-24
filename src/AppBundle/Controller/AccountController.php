<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use AppBundle\Entity\DebitCard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Account controller.
 *
 */
class AccountController extends Controller
{
    /**
     * Lists all account entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accounts = $em->getRepository('AppBundle:Account')->findAll();

        return $this->render('account/index.html.twig', array(
            'accounts' => $accounts,
        ));
    }

    /**
     * Creates a new account entity.
     *
     */
    public function newAction(Request $request)
    {
        $account = new Account();
        $debitc = new DebitCard();

        //Sofisticated algorithym to ensure uniqueness
        $fecha = new \DateTime('now');
        $cad = md5($fecha->format('d-M-Y H:s:i'));
        $cad = substr($cad, 0, 20);
        $account->setNumber($cad);
        $account->setType('Saving');

        $form = $this->createForm('AppBundle\Form\AccountType', $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $customer = $account->getOwner();
            $debitc->setCardno(str_pad(rand(0, pow(10, 20)-1), 20, '0', STR_PAD_LEFT));
            $debitc->setOwnedby($customer);
            $debitc->setBank($customer->getBank());
            $debitc->setAccount($account);

            $em->persist($debitc);
            $em->persist($account);
            $em->flush();

            $this->get('session')->getFlashBag()->add('exito', "A new account has been created.");

            return $this->redirectToRoute('account_show', array('id' => $account->getId()));
        }

        return $this->render('account/new.html.twig', array(
            'account' => $account,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a account entity.
     *
     */
    public function showAction(Account $account)
    {
        $deleteForm = $this->createDeleteForm($account);
        $em = $this->getDoctrine()->getManager();
        $transferences = $em->getRepository('AppBundle:Transferences')->getTransferences($account->getOwner()->getId());

        return $this->render('account/show.html.twig', array(
            'account' => $account,
            'transactions' => $transferences,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing account entity.
     *
     */
    public function editAction(Request $request, Account $account)
    {
        $deleteForm = $this->createDeleteForm($account);
        $editForm = $this->createForm('AppBundle\Form\AccountType', $account);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add('exito', "Edition was successfull");

            return $this->redirectToRoute('account_show', array('id' => $account->getId()));
        }

        return $this->render('account/edit.html.twig', array(
            'account' => $account,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a account entity.
     *
     */
    public function deleteAction(Request $request, Account $account)
    {
        $form = $this->createDeleteForm($account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($account);
            $em->flush();

            $this->get('session')->getFlashBag()->add('exito', "It is always hard to say goodbye. This account is closed for good."); 
        }

        return $this->redirectToRoute('account_index');
    }

    /**
     * Creates a form to delete a account entity.
     *
     * @param Account $account The account entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Account $account)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('account_delete', array('id' => $account->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
