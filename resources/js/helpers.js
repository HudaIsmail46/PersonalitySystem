import dateFormat  from 'dateformat';
require('dateformat');

export const dateFormatter = (dateTime) => {
    return (
        dateFormat(dateTime, " yyyy-mm-dd HH:MM").substring(0, 19)
    );
}

export const humaniseOrderState = (state) => {
    return (
            state.replace( "App\\State\\Order\\", "")
                .replace(/([a-z])([A-Z])/g, '$1 $2')
    );
}

