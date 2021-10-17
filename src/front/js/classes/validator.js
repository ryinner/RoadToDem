// Класс валидатор, принимает в себя, паттерн регулярное выражение, само значение поля, проверяемый input
// Метод validate Осуществляет выделение поля и проверку по регулярному выражению
// Метод isEmpty проверяет пустое ли значение импута, если да, меняет внешний вид и возвращает true
class Validator
{
    constructor(validObject, validValue, validPattern = null)
    {
        this.validPattern = validPattern
        this.validValue = validValue;
        this.validObject = validObject;
    }

    validate()
    {
        let result = this.validPattern.test(this.validValue);
        
        if (result == false) {
            this.validObject.addClass('invalid');
        }
        
        return result;
    }

    isEmpty()
    {
        if (this.validValue == '') {
            this.validObject.addClass('invalid');
            return true;
        }
    }
}