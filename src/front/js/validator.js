// Класс валидатор, принимает в себя, паттерн регулярное выражение, само значение поля, проверяемый input
// Метод validate Осуществляет выделение поля и проверку по регулярному выражению

class Validator
{
    constructor(validPattern,validValue,validObject = null)
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
}