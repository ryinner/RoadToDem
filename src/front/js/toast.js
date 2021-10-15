// Класс Toast принимает в себя имя сообщения, само содержимое сообщения, CSS-класс
// Метод show отрисовывает сообщение в специальном блоке, через три секунды оно исчезает

class Toast {

    constructor(name,content,classCss) 
    {
        this.name = name;
        this.content = content;
        this.classCss = classCss;
        this.rand = new Date().getTime();
    }

    show() 
    {
        this.classCss;
        $('.toasts__container').append(
            '<div class=' + this.rand + '><span>' + this.content + '</span></div>');
            $('.' + this.rand).addClass(this.classCss);
            $('.' + this.rand).addClass('toast');
    }
    

    hide()
    {
        setTimeout(() => $('.' + this.rand).remove(), 3000);
    }
}