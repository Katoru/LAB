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

  private $locales_values;
  private $locales_labels;

  public function __construct(private TranslatorInterface $translator, private LocaleSwitcher $localeSwitcher, string $locales_values, string $locales_labels)
  {
    $this->locales_values = $locales_values;
    $this->locales_labels = $locales_labels;
  }

  #[Route('/', name: 'homeWithoutLocale')]
  public function indexNoLocale(Request $request): Response
  {
    $locale = 'en';
    $route = 'home';
    if ($request->query->get('lang') != null) {
      $locale = $request->query->get('lang');
    }
    if ($request->request->get('lang') != null) {
      $locale = $request->request->get('lang');
    }
    if ($request->request->get('originURL')) {
      $route = $request->request->get('originURL');
    }

    return $this->redirectToRoute($route, ['_locale' => $locale]);
  }

  #[Route('/{_locale}', name: 'home')]
  public function home(Request $request): Response
  {

    $response = new Response();
    $content = $this->renderView('index/index.html.twig', []);
    $response->setContent($content);

    return $response;
  }

  #[Route('/{_locale}/discography', name: 'discography')]
  public function discography(Request $request): Response
  {
    $response = new Response();
    $content = $this->renderView('index/index.html.twig', []);
    $response->setContent($content);

    return $response;
  }

  #[Route('/{_locale}/biography', name: 'biography')]
  public function biography(Request $request): Response
  {
    $response = new Response();
    $content = $this->renderView('index/index.html.twig', []);
    $response->setContent($content);

    return $response;
  }

  #[Route('/{_locale}/tour', name: 'tour')]
  public function tour(Request $request): Response
  {
    $response = new Response();
    $content = $this->renderView('index/index.html.twig', []);
    $response->setContent($content);

    return $response;
  }

  #[Route('/{_locale}/newsletter', name: 'newsletter')]
  public function newsletter(Request $request): Response
  {
    $response = new Response();
    $content = $this->renderView('index/index.html.twig', []);
    $response->setContent($content);

    return $response;
  }
}
