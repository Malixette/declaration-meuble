class Caroussel{

/*
*@param {HTMLElement} element
*@param {Object} options
*@âram {Object} options.slidesToScroll Nombre d'éléments à faire défiler
*@âram {Object} options.slidesVisisbles. Nombre d'éléments visible dans un slide
*/

    constructor (element, options = {}) { //si pas d'options on met un objet vide
        this.element = element;
        this.options = Object.assign({}, {
            slidesToScroll:1,
            slidesVisibles:1
        }, options)
        let children = [].slice.call(element.children)
        let root = this.createDivWithClass('carousel')
        this.container = this.createDivWithClass('carousel__container');
        root.appendChild(this.container);
        this.element.appendChild(root);
        this.items = children.map((child) => {
            let item = this.createDivWithClass('carousel__item');
            item.appendChild(child);
            this.container.appendChild(child);
            return item
        })
        this.setStyle()
    }
    
    setStyle () {  //methode pour calculer les ratios pour être responsive
        let ratio = this.items.length / this.options.slidesVisible;
        this.container.style.width = (ratio * 100) +"%";
        this.items.forEach(item => item.style.width = ((100 / this.slidesVisible) / ratio) + "%");
    }

    /**
     * @param {string} className
     * @returns (HTMLElement)
     */
    createDivWithClass (className) {
        let div = document.createElement('div');
        div.setAttribute('class', className);
        return div;
    }


}

document.addEventListener('DOMcontentLoaded', function() { //comme le chargement de la page est asynchrone on demande d'attendre le chargement du DOM

    new Carousel (document.querySelector('#carousel1'), {
        slidesToScroll: 1,
        slidesVisible:3
    })
})