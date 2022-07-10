new Vue({
    el: "#app",
    data: {
      index: 0,
    },
    mounted() {
        const images = document.getElementsByClassName('slideshow');
        this.slideshow(images);
        setInterval(() => {
            this.index = this.index < images.length - 1 ? this.index + 1 : 0;
            this.slideshow(images);
        }, 5000);
    },
    methods: {
        slideshow(images) {
            const current = images[this.index];
            const prev = images[this.index - 1] ? images[this.index - 1] : images[images.length - 1];
            current.classList.add('fadein');
            current.classList.remove('fadeout');
            prev.classList.remove('fadein');
            prev.classList.add('fadeout');
        }
    }
  })