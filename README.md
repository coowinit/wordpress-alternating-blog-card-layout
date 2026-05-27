# Blog Alternating Cards Layout

这是一个仿照参考图制作的博客文章交错布局示例，适合用于 WordPress 文章列表、博客归档页、产品资讯列表页等。

## 文件结构

```text
wp-blog-alternating-layout/
├─ index.html
├─ wordpress-loop-example.php
└─ assets/
   ├─ css/
   │  └─ blog-layout.css
   ├─ js/
   │  └─ blog-layout.js
   └─ images/
      ├─ blog-illustration-media.svg
      ├─ blog-illustration-video.svg
      ├─ blog-illustration-shop.svg
      ├─ blog-illustration-checkout.svg
      ├─ blog-illustration-marketing.svg
      └─ blog-illustration-store.svg
```

## 核心实现

- 桌面端：使用 CSS Grid 实现图片与文字卡片左右交错，并添加轻微重叠效果。
- 已统一奇数行和偶数行的文字卡片宽度：文字盒子占 5 栏，并通过 `width: calc(100% + var(--overlap))` 实现等宽重叠。
- 手机端：统一改为上下结构，图片始终在最上面，文字卡片在下面。
- WordPress 循环友好：每个卡片结构完全一致，偶数项只需要额外添加 `is-reverse` 类。
- 图片使用 SVG 占位插画，后续可替换为 WordPress 特色图。
- CSS 和 JS 已独立分离，方便放入主题目录或子主题目录。

## WordPress 循环输出要点

普通项：

```html
<article class="blog-card">...</article>
```

反向项：

```html
<article class="blog-card is-reverse">...</article>
```

PHP 循环中可以这样判断：

```php
$is_reverse = ( $index % 2 === 1 ) ? ' is-reverse' : '';
```

手机端不需要额外处理，CSS 会自动让图片排在内容上方。

## 使用方式

1. 直接打开 `index.html` 可以预览静态效果。
2. 把 `assets/css/blog-layout.css` 和 `assets/js/blog-layout.js` 放到主题目录中并正确引入。
3. 参考 `wordpress-loop-example.php` 把 HTML 结构改成 WordPress 循环输出。
4. 后续上线时，把 SVG 占位图替换成 `the_post_thumbnail()` 输出的特色图即可。
