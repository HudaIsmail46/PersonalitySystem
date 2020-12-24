import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import Select from 'react-select'

function SelectCustomer(props) {
    const { customer_options, selected_customer} = props;
    const [selectedOption, setSelectedOption] = useState(selected_customer);
    

    return (
        <Select
            defaultValue={selectedOption}
            onChange={setSelectedOption}
            options={customer_options}
            name='customer_id'/>
    )
}

export default SelectCustomer;
const element = document.getElementById("SelectCustomer");

if (element) {
    let props = Object.assign({}, element.dataset);
    Object.keys(props).map(key=> props[key] = JSON.parse(props[key]));
    ReactDOM.render(<SelectCustomer {...props}/>, element);
}
