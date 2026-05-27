/*
  简单 Load More 示例。
  WordPress 实际项目中可以替换成 AJAX 加载，或者直接使用后台分页。
*/
(function () {
  const list = document.querySelector('[data-blog-list]');
  const loadMoreButton = document.querySelector('[data-load-more]');

  if (!list || !loadMoreButton) return;

  const items = Array.from(list.querySelectorAll('[data-blog-item]'));
  const initialCount = 4;
  const perClick = 2;
  let visibleCount = initialCount;

  function render() {
    items.forEach((item, index) => {
      item.hidden = index >= visibleCount;
    });

    if (visibleCount >= items.length) {
      loadMoreButton.hidden = true;
    }
  }

  loadMoreButton.addEventListener('click', () => {
    visibleCount += perClick;
    render();
  });

  render();
})();
