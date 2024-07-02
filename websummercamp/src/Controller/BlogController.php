<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{

    public function __construct(
        private BlogRepository $blogRepository,
    )
    {
    }

    #[Route('/blogs', name: 'app_blogs')]
    public function getBlogs(): Response
    {
        $blogs = $this->blogRepository->getAllBlogs();

        return $this->render('blog/list.html.twig', [
            'blogs' => $blogs,
        ]);
    }

    #[Route('/blogs/new', name: 'app_blog_new')]
    public function createBlog(Request $request): Response
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blog->setCreatedAt(new \DateTimeImmutable());
            $this->blogRepository->save($blog);

            return $this->redirectToRoute('app_blogs');
        }

        return $this->render('blog/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/blogs/{blog}', name: 'app_blog')]
    public function getBlog(Blog $blog): Response
    {
        return $this->render('blog/single.html.twig', [
            'blog' => $blog,
        ]);
    }

    #[Route('/blogs/{blog}/delete', name: 'app_delete_blog')]
    public function deleteBlog(Blog $blog): Response
    {
        $this->blogRepository->delete($blog);

        return $this->redirectToRoute('app_blogs');
    }

    #[Route('/api/blogs/titles', name: 'app_api_blogs_titles')]
    public function getBlogsTitles(): Response
    {
        $blogs = $this->blogRepository->getAllBlogs();
        $numberOfBlogs = $this->blogRepository->getNumberOfBlogs();

        $titles = array_map(function ($blog) {
            return ['title' => $blog->getTitle()];
        }, $blogs);

        return $this->json(['totalRecords' => $numberOfBlogs, 'titles' => $titles]);
    }
}
