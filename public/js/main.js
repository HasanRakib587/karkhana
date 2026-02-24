document.addEventListener("DOMContentLoaded", () => {
  const row = document.querySelector(".also-like .row:nth-of-type(2)");
  const nextBtn = document.querySelector(".swiper-next");

  const scrollNext = () => {
    const firstCol = row.querySelector(".col-md-3");
    const cardWidth = firstCol.offsetWidth;
    row.scrollBy({ left: cardWidth, behavior: "smooth" });

    setTimeout(() => {
      row.appendChild(firstCol);
      row.scrollLeft -= cardWidth;
    }, 400);
  };

  const scrollPrev = () => {
    const lastCol = row.lastElementChild;
    const cardWidth = lastCol.offsetWidth;

    row.insertBefore(lastCol, row.firstElementChild);
    row.scrollLeft += cardWidth;

    row.scrollBy({ left: -cardWidth, behavior: "smooth" });
  };

  // ✅ Button / Link click (with preventDefault for <a>)
  nextBtn.addEventListener("click", (e) => {
    e.preventDefault();
    scrollNext();
  });

  // ✅ Touch swipe (mobile)
  let startX = 0;
  row.addEventListener("touchstart", (e) => {
    startX = e.touches[0].clientX;
  });
  row.addEventListener("touchend", (e) => {
    let endX = e.changedTouches[0].clientX;
    let diffX = startX - endX;
    if (Math.abs(diffX) > 50) {
      diffX > 0 ? scrollNext() : scrollPrev();
    }
  });

  // ✅ Mouse drag (desktop)
  let isDown = false;
  let startDragX;
  let scrollLeftStart;

  row.addEventListener("mousedown", (e) => {
    isDown = true;
    row.classList.add("dragging");
    startDragX = e.pageX;
    scrollLeftStart = row.scrollLeft;
    e.preventDefault(); // prevent selecting text/images
  });

  row.addEventListener("mouseleave", () => {
    isDown = false;
    row.classList.remove("dragging");
  });

  row.addEventListener("mouseup", (e) => {
    if (!isDown) return;
    isDown = false;
    row.classList.remove("dragging");

    let diffX = startDragX - e.pageX;
    if (Math.abs(diffX) > 50) {
      diffX > 0 ? scrollNext() : scrollPrev();
    }
  });

  row.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    const x = e.pageX;
    const walk = (x - startDragX) * 1; // adjust multiplier for drag speed
    row.scrollLeft = scrollLeftStart - walk;
  });
});


