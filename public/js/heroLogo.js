// // Register GSAP plugins (global namespace when using CDN)
// gsap.registerPlugin(ScrollTrigger);

// // --- Function to calculate scales based on screen width ---
// function getScales() {
//     if (window.innerWidth <= 576) {
//         return { start: 3, end: 1.2 };   // mobile
//     } else if (window.innerWidth <= 768) {
//         return { start: 4, end: 1.2 };   // tablet
//     } else {
//         return { start: 6, end: 1 };     // desktop
//     }
// }

// // Initial states
// gsap.set(".nav__bg", { opacity: 0 });
// gsap.set(".logo", { y: "50vh", scale: 6, yPercent: -50, transformOrigin: "center center" });

// // Initialize scales
// let { start: startScale, end: endScale } = getScales();

// // Timeline with ScrollTrigger
// const tl = gsap.timeline({
//     scrollTrigger: {
//         trigger: ".hero",
//         start: "top top",
//         end: "bottom top",
//         scrub: 1,       // makes easing feel smooth when scrolling
//         pin: ".logo",
//         pinSpacing: false
//     }
// });

// tl.fromTo(
//     ".logo",
//     {
//         y: "50vh",       // start lower
//         scale: startScale, // start larger
//         yPercent: -50,
//     },
//     { 
//         y: 0,            // end at navbar baseline
//         scale: endScale, // normal size
//         yPercent: 0, 
//         ease: "power2.out" 
//     }
// );

// tl.to(".nav__bg", {
//     opacity: 1,
//     ease: "power1.out"
// }, "<"); // sync fade-in with logo movement

// Handle window resize: invalidate and refresh
// window.addEventListener("resize", () => {
//     // Reset logo to new start values
//     gsap.set(".logo", { scale: .6 });

//     // Invalidate & refresh timeline
//     tl.invalidate();
//     ScrollTrigger.refresh();
// });

// // Refresh ScrollTrigger on page load
// window.addEventListener("load", () => {
//     ScrollTrigger.refresh();
// });


// gsap.registerPlugin(ScrollTrigger);

// gsap.set(".nav__bg", { opacity: 0 });
// gsap.set(".logo", { yPercent: -50, transformOrigin: "center center" });

// ScrollTrigger.matchMedia({
//   // --- Mobile ---
//   "(max-width: 576px)": function() {
//     createScrollAnimation({
//       startScale: 2,       // smaller difference = smoother
//       endScale: .7,
//       startY: "35vh",      // less vertical movement
//       endY: "0vh",
//       scrub: 0.7,          // slightly slower scrub for smoother feel
//       duration: 1.2,        // fine-tune easing speed     

//     });
//   },

//   // --- Tablet ---
//   "(min-width: 577px) and (max-width: 768px)": function() {
//     createScrollAnimation({
//       startScale: 3.5,
//       endScale: 1.1,
//       startY: "45vh",
//       endY: "0vh",
//       scrub: 1
//     });
//   },

//   // --- Desktop ---
//   "(min-width: 769px)": function() {
//     createScrollAnimation({
//       startScale: 6,
//       endScale: 1,
//       startY: "50vh",
//       endY: "0vh",
//       scrub: 1.2
//     });
//   }
// });

// function createScrollAnimation({ startScale, endScale, startY, endY, scrub }) {
//   // Set initial state
//   gsap.set(".logo", { y: startY, scale: startScale, yPercent: -50 });

//   const tl = gsap.timeline({
//     scrollTrigger: {
//       trigger: ".hero",
//       start: "top top",
//       end: "bottom top",
//       scrub: scrub || 1,
//       pin: ".logo",
//       pinSpacing: false,
//       anticipatePin: 1,    // prevents jump at pin start
//       fastScrollEnd: true  // smoother end on mobile
//     }
//   });

//   tl.to(".logo", {
//     y: endY,
//     scale: endScale,
//     yPercent: 0,
//     ease: "power2.out",
//     duration: 1
//   });

//   tl.to(".nav__bg", { opacity: 1, ease: "power1.out" }, "<");
// }

// window.addEventListener("resize", () => ScrollTrigger.refresh());

gsap.registerPlugin(ScrollTrigger);

gsap.set(".nav__bg", { opacity: 0 });
gsap.set(".logo", { transformOrigin: "center center" });

ScrollTrigger.matchMedia({
  "(max-width: 576px)": () => createScrollAnimation({ startScale: 2, endScale: .7, startY: "35vh", endY: "0vh", scrub: 0.7 }),
  "(min-width: 577px) and (max-width: 768px)": () => createScrollAnimation({ startScale: 3.5, endScale: 1.1, startY: "45vh", endY: "0vh", scrub: 1 }),
  "(min-width: 769px)": () => createScrollAnimation({ startScale: 6, endScale: 1, startY: "50vh", endY: "0vh", scrub: 1.2 })
});

function createScrollAnimation({ startScale, endScale, startY, endY, scrub }) {
  gsap.set(".logo", { y: startY, scale: startScale, transformOrigin: "center center" });

  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".hero",
      start: "top top",
      end: "bottom top",
      scrub,
      pin: ".logo-wrapper",
      pinSpacing: false,
      anticipatePin: 1,
      fastScrollEnd: true,
      invalidateOnRefresh: true
    }
  });

  tl.to(".logo", {
    y: endY,
    scale: endScale,
    ease: "power2.out",
    duration: 1
  });

  tl.to(".nav__bg", { opacity: 1, ease: "power1.out" }, "<");
}

window.addEventListener("load", () => setTimeout(() => ScrollTrigger.refresh(), 200));
window.addEventListener("resize", () => ScrollTrigger.refresh());

