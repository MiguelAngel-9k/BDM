class Button{

    static bLink({href, text, size, weight, color, align, tColor}){
        const anchore = document.createElement('a');
        anchore.href = href;
        anchore.className = `btn btn-${color} fs-${size} fw-${weight} text-${tColor} text-${align}`;

        anchore.textContent = text;

        return anchore;
    }

}