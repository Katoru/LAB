<?php

namespace App\Controller;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Translation\LocaleSwitcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
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

  #[Route('/', name: 'home')]
  public function home(Request $request): Response
  {
    $newLocale = $request->cookies->get('locale');
    if ($request->query->get('lang') != null)
      $newLocale = $request->query->get('lang');
    if ($request->request->get('lang') != null)
      $newLocale = $request->request->get('lang');

    $locales_values = explode("|", $this->locales_values);
    $locales_labels = explode("|", $this->locales_labels);
    if (in_array($newLocale, $locales_values)) {
      $this->localeSwitcher->setLocale($newLocale);
    }

    $expires = time() + (86400 * 30);
    $cookie = Cookie::create('locale', $newLocale,  $expires);
    //$cookie = $response->headers->setCookie(Cookie::create('foo', 'bar'));
    $response = new Response();
    $response->headers->setCookie($cookie);
    $content = $this->renderView('index/index.html.twig', [
      'locale' => $this->localeSwitcher->getLocale(),
      'locales_values' => $locales_values,
      'locales_labels' => $locales_labels,
    ]);
    $response->setContent($content);

    return $response;
  }
}
