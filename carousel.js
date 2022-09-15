 

const content = document.querySelector('#content');
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
            href: 'product.html',
            text: 'Ver mas',
            tColor: 'light',
            color: 'success'
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
    
})
