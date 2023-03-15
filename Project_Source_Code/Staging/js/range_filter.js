const filterButton = document.querySelector('#filter-button');
  const circles = document.querySelectorAll('circle');

  filterButton.addEventListener('click', () => {
    const fromYear = parseInt(document.querySelector('#from-year').value);
    const toYear = parseInt(document.querySelector('#to-year').value);

    circles.forEach(circle => {
      const year = parseInt(circle.dataset.year);

      if (year >= fromYear && year <= toYear) {
        circle.style.display = 'inline';
      } else {
        circle.style.display = 'none';
      }
    });
  });
