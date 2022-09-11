class Card{

    constructor({img, title, text, link, desc, size = 4}){
        this.img = img;
        this.title = title;
        this.text = text;
        this.link = link;
        this.desc = desc;
        this.bConfig = text;

        this.card = document.createElement('div');
        this.card.className = 'card';
        this.card.style.width = '18rem';

        const body = this.body(this.title, this.desc, this.bConfig);
        const cover = this.cover(this.img);

        this.card.append(cover, body);

    }

    draw(){

        const wrapper = document.createElement('div');
        wrapper.className = `col-${size}  d-flex justify-content-center`;

        const card = document.createElement('div');
        card.className = 'card';
        card.style.width = '18rem';

        const body = this.body(this.title, this.desc, this.bConfig);
        const cover = this.cover(this.img);

        card.append(cover, body);
        wrapper.append(card);

        return wrapper;

    }

    cover(img){
        const cover = document.createElement('img');
        cover.src = img;
        cover.className = 'card-img-top';

        return cover;
    }



    body(title, description, text){

        const container = document.createElement('div');
        container.className = 'card-body';

        const head = this.bodyHead(title);
        const content = this.bodyDescription(description);
        const bLink = Button.bLink(text);

        container.append(head, content, bLink);
        return container;

    }

    bodyHead(title){
        const head = document.createElement('h5');
        head.className = 'card-title';
        head.textContent = title;

        return head;
    }

    bodyDescription(desc){
        const description = document.createElement('p');
        description.className = 'card-text';
        description.textContent = desc;

        return description;
    }



}