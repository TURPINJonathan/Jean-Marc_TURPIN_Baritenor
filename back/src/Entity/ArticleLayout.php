<?php

namespace App\Entity;

use App\Repository\ArticleLayoutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ArticleLayoutRepository::class)]
class ArticleLayout
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article_get'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['article_get'])]
    private ?int $choice = null;

    #[ORM\OneToMany(mappedBy: 'layout', targetEntity: Article::class)]
    private Collection $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChoice(): ?int
    {
        return $this->choice;
    }

    public function setChoice(int $choice): static
    {
        $this->choice = $choice;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setLayout($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getLayout() === $this) {
                $article->setLayout(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getChoice();
    }
}
