const card = ({img, title, text, link})=>{

    // COL CONTAINER
    const container = document.createElement('div');
    container.className = 'col-4  d-flex justify-content-center';

    // CARD
    const card = document.createElement('div');
    card.className = 'card';
    card.style.width = '18rem';

    // CARD IMAGE
    const cover = document.createElement('img');
    cover.src = img;
    cover.className = 'card-img-top';

    // CARD BODY
    const body = document.createElement('div');
    body.className = 'card-body';

    // CARD CONTENT
    const head = document.createElement('h5');
    head.className = 'card-title';
    head.textContent = title;

    const desc = document.createElement('p');
    desc.className = 'card-text';
    desc.textContent = text;

    const button = document.createElement('a');
    button.href = link;
    button.className = 'btn btn-primary';
    button.textContent = 'Show more';

    body.append(head, desc, button);
    card.append(cover, body);
    container.append(card);

    return container;

}

const content = document.querySelector('#content');
const prev = document.querySelector('#prev');
const next = document.querySelector('#next');
let segment = 1;
const min = 1;
const cards = [];

for(let i = 0; i < 18 ; i++){
    
    const carta = card({
        img: 'https://m.media-amazon.com/images/I/718sn7oOcfL._AC_SY450_.jpg',
        title: 'Computadora' + i,
        text: 'Some quick example text to build on the card title and make up the bulk of the',
        link: '#',
    })
    
    cards.push(carta);
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
