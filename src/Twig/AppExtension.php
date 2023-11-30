<?php 

namespace App\Twig;

use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository= $categoryRepository;    
    }

    public function getFunctions(){
        return [
            new TwigFunction('categorieNavbar', [$this, 'category'])
        ];
    }

    public function category(): array{
        return $this->categoryRepository->findAll();
    }
}