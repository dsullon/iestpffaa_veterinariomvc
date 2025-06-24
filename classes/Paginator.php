<?php

namespace Classes;

class Paginator {
    public int $page;
    public int $perPage;
    public int $total;
    public int $totalPages;
    public array $params;

    public function __construct(int $page, int $perPage, int $total, array $params = []) {
        $this->page = max(1, $page);
        $this->perPage = max(1, $perPage);
        $this->total = max(0, $total);
        $this->totalPages = (int) ceil($total / $perPage);
        $this->params = $params;
    }

    public function link(int $page, string $text = ""): string {
        $page = max(1, min($page, $this->totalPages));
        $query = array_merge($this->params, ['page' => $page, 'per_page' => $this->perPage]);
        $url = '?' . http_build_query($query);
        $text = $text ?? $page;
        return "<a href=\"$url\">$text</a>";
    }

    public function render(): string {
        if ($this->totalPages <= 1) return '';

        $html = '<nav class="pagination">';
        if ($this->page > 1) {
            $html .= $this->link(1, '« Primero');
            $html .= $this->link($this->page - 1, '‹ Anterior');
        }

        // Números de página (puedes ajustarlo a mostrar solo 5, por ejemplo)
        for ($i = 1; $i <= $this->totalPages; $i++) {
            if ($i == $this->page) {
                $html .= "<span class=\"current\">$i</span>";
            } else {
                $html .= $this->link($i);
            }
        }

        if ($this->page < $this->totalPages) {
            $html .= $this->link($this->page + 1, 'Siguiente ›');
            $html .= $this->link($this->totalPages, 'Último »');
        }

        $html .= '</nav>';
        return $html;
    }
}