
class Carousel{

    static carousels = 0;

    constructor(text, cards = []){

        this.prev = prev;
        this.carousels += 1;

        this.segment = 1;
        this.min = 1;
        this.max = cards.length / 3;

        this.cards = cards;

        this.wrapper = this.content(text, cards);

    }

    content({color, weight, size}, cards = []){
        const wrapper = document.createElement('div');
        wrapper.className = 'row justify-content-center p-3 m-3';

        const header = document.createElement('h2');
        header.className = `text-${color} fw-${weight} fs-${size}`;

        const row = document.createElement('div');
        row.className = 'col';

        const slider = document.createElement('div');
        slider.className = 'row justify-content-center';
        slider.id = `carousel-${this.carousels}`;

        slider.append(...cards.slice(0, 3));

        row.append(slider);

        const leftControl = this.control('left');
        const rightControl = this.control('right');

        wrapper.append(header, rightControl, row, leftControl);

        return wrapper;

    }

    control(side){
        const button = document.createElement('div');
        button.className = 'col-1 align-items-center d-flex';

        const content = document.createElement('p');
        content.className = 'text-light mx-auto text-center';
        
        if(side === 'RIGHT'){
            content.id = `right-${this.carousels}`;
            content.textContent = 'RIGHT';
        }else if(side === 'LEFT'){
            content.id = `left-${this.carousels}`;
            content.textContent = 'LEFT';
        }
    }

}

const cards = [];

for(let i = 0; i < 18 ; i++){
    
    const carta = new Card({
        img: 'https://m.media-amazon.com/images/I/718sn7oOcfL._AC_SY450_.jpg',
        title: 'Computadora' + i,
        desc: 'Some quick example text to build on the card title and make up the bulk of the',
        link: '#',
        text:{
            href: '#',
            text: 'Show more',
            tColor: 'light',
            color: 'primary'
        }
    })
    
    cards.push(carta.card);
}

const carousel = new Carousel({}, cards);
document.querySelector('#main').append(carousel.wrapper);

/* const content = document.querySelector('#content');
const prev = document.querySelector('#prev');
const next = document.querySelector('#next');
let segment = 1;
const min = 1;
const cards = [];

for(let i = 0; i < 18 ; i++){
    
    const carta = new Card({
        img: 'https://m.media-amazon.com/images/I/718sn7oOcfL._AC_SY450_.jpg',
        title: 'Computadora' + i,
        desc: 'Some quick example text to build on the card title and make up the bulk of the',
        link: '#',
        text:{
            href: '#',
            text: 'Show more',
            tColor: 'light',
            color: 'primary'
        }
    })
    
    cards.push(carta.card);
}


const max = cards.length/3;
content.append(...cards.slice(0, 3));

document.body.addEventListener('click', (e)=>{

    if(e.target.id === "prev"){
        segment = segment > min ? segment - 1 : segment;
        // console.log(`Segmento Actual ${segment}`);
        while(content.firstChild)
            content.removeChild(content.firstChild);

        const list = cards.slice((3*(segment - 1)), (3*(segment - 1)) + 3);
        content.append(...list);
    }else if(e.target.id === "next"){
        segment = segment < max ? segment + 1 : segment;
        // console.log(`Segmento Actual ${segment}`);
        while(content.firstChild)
            content.removeChild(content.firstChild);
        const list = cards.slice((3*(segment - 1)), (3*(segment - 1)) + 3);
        content.append(...list);
    }
    
}) */
