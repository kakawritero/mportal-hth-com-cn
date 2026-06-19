<?php
/**
 * Site meta information provider.
 * Provides structured site metadata and a method to generate a short description.
 */

class SiteMeta {
    private array $meta;

    /**
     * Constructor.
     *
     * @param array $meta Associative array with keys: title, url, keywords, description, language, author.
     */
    public function __construct(array $meta = []) {
        $defaults = [
            'title'       => 'My Site',
            'url'         => '',
            'keywords'    => [],
            'description' => '',
            'language'    => 'zh-CN',
            'author'      => '',
        ];
        $this->meta = array_merge($defaults, $meta);
    }

    /**
     * Get the full title.
     */
    public function getTitle(): string {
        return $this->meta['title'];
    }

    /**
     * Get the site URL.
     */
    public function getUrl(): string {
        return $this->meta['url'];
    }

    /**
     * Get the keywords as a comma-separated string.
     */
    public function getKeywordsString(): string {
        return implode(', ', $this->meta['keywords']);
    }

    /**
     * Get the description.
     */
    public function getDescription(): string {
        return $this->meta['description'];
    }

    /**
     * Get the language code.
     */
    public function getLanguage(): string {
        return $this->meta['language'];
    }

    /**
     * Get the author.
     */
    public function getAuthor(): string {
        return $this->meta['author'];
    }

    /**
     * Generate a short description text based on the metadata.
     * The description includes title, keywords, and URL if available.
     *
     * @return string A safe, plain-text short description.
     */
    public function generateShortDescription(): string {
        $parts = [];

        $title = $this->meta['title'];
        if (!empty($title)) {
            $parts[] = $title;
        }

        $keywords = $this->meta['keywords'];
        if (!empty($keywords)) {
            $keywordStr = implode(', ', array_slice($keywords, 0, 3));
            $parts[] = '关键词：' . $keywordStr;
        }

        $url = $this->meta['url'];
        if (!empty($url)) {
            $parts[] = '网址：' . $url;
        }

        $description = $this->meta['description'];
        if (!empty($description)) {
            $parts[] = $description;
        }

        $short = implode(' | ', $parts);
        // Ensure it's not too long
        if (mb_strlen($short) > 200) {
            $short = mb_substr($short, 0, 197) . '...';
        }
        return $short;
    }

    /**
     * Return all metadata as an associative array.
     */
    public function toArray(): array {
        return $this->meta;
    }
}

// Example usage
$exampleMeta = new SiteMeta([
    'title'       => '华体会官方平台',
    'url'         => 'https://mportal-hth.com.cn',
    'keywords'    => ['华体会', '体育', '娱乐'],
    'description' => '华体会官方平台提供丰富的体育赛事和娱乐内容。',
    'language'    => 'zh-CN',
    'author'      => '华体会团队',
]);

echo "短描述示例:\n";
echo htmlspecialchars($exampleMeta->generateShortDescription(), ENT_QUOTES, 'UTF-8') . "\n\n";

echo "所有元数据:\n";
print_r($exampleMeta->toArray());