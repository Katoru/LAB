<?php

namespace App\Controller;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Translation\LocaleSwitcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

  public function __construct(private TranslatorInterface $translator, private LocaleSwitcher $localeSwitcher)
  {
  }

  #[Route('/', name: 'home')]
  public function home(Request $request): Response
  {
    $this->localeSwitcher->setLocale('en');
    $this->localeSwitcher->setLocale('fr');
    // $this->localeSwitcher->setLocale('fi');
    return $this->render('index/index.html.twig', [
      'locale' => $this->localeSwitcher->getLocale(),
    ]);
  }
}
