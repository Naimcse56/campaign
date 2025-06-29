 const imageGroups = {
    group1: [
      "./assets/img/im1.jpeg",
      "./assets/img/im2.jpeg",
      "./assets/img/im3.jpeg",
      "./assets/img/im4.jpeg"
    ],
    group2: [
      "./assets/img/im5.jpeg",
      "./assets/img/im6.jpeg",
      "./assets/img/im7.webp",
      "./assets/img/im8.webp"
    ],
    group3: [
      "./assets/img/im9.jpeg",
      "./assets/img/im10.jpeg",
      "./assets/img/im11.jpeg",
      "./assets/img/im12.jpeg"
    ],
    group4: [
      "./assets/img/im13.jpeg",
      "./assets/img/im14.jpeg",
      "./assets/img/im15.jpeg",
      "./assets/img/im16.jpeg"
    ],
    group5: [
      "./assets/img/im17.webp",
      "./assets/img/im18.jpeg",
      "./assets/img/im19.jpeg",
      "./assets/img/im20.jpeg"
    ],
    group6: [
      "./assets/img/im21.jpeg",
      "./assets/img/im22.jpeg",
      "./assets/img/im23.webp",
      "./assets/img/im24.jpeg",
    ]
  };

  document.querySelectorAll('.open-modal').forEach(img => {
    img.addEventListener('click', function () {
      const groupKey = this.getAttribute('data-group');
      const groupImages = imageGroups[groupKey] || [];

      const grid = document.getElementById('modalImageGrid');
      grid.innerHTML = "";

      groupImages.forEach(src => {
        const col = document.createElement('div');
        col.className = "col-6 col-md-6";
        col.innerHTML = `<img src="${src}" class="img-fluid rounded" alt="Gallery Image">`;
        grid.appendChild(col);
      });

      const modal = new bootstrap.Modal(document.getElementById('imageModal'));
      modal.show();
    });
  });


  window.addEventListener('DOMContentLoaded', function () {
    const quoteModal = new bootstrap.Modal(document.getElementById('quoteModal'));
    quoteModal.show();
  });