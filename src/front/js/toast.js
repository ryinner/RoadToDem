// Класс Toast принимает в себя имя сообщения, само содержимое сообщения, CSS-класс
// Метод show отрисовывает сообщение в специальном блоке, через три секунды оно исчезает

class Toast {

    constructor(name,content,classCss) 
    {
        this.name = name;
        this.content = content;
        this.classCss = classCss;
    }

    show() 
    {
        this.classCss;
        $('.toasts').append(
            '<div class=' + this.name + '><span>' + this.content + '</span></div>');
            $('.' + this.name).addClass(this.classCss);
        setTimeout(() => $('.' + this.name).remove(), 3000);
    }

}