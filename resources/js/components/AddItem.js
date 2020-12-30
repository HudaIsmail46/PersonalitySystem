import React, { useState } from "react";
import ReactDOM from 'react-dom';


function AddItem(props) {
    const { sizes, materials } = props;
    const [ itemfields, setItemfields] = useState(1);


    const addItemsField = () => {
        const newItemfields = itemfields + 1;
        setItemfields(newItemfields)
    }

    const removeItemsField = () => {
        const currentItemfields = itemfields - 1;
        setItemfields(currentItemfields)
    }

    const displayAddItems = () => {

        var rows = [];
        for (var i = 0; i < itemfields; i++) {
            rows.push(<div className="table-responsive">
                <table className="table table-bordered" id="dynamic_field">
                    <tr>
                        <td>
                            <select id="material" name="material[]" className="custom-select ">
                                <option key='selectMaterial' value="">SELECT MATERIAL</option>
                                {materials.map((material) => {
                                    return (
                                        <option key={material} value={material}> {material}</option>
                                    );
                                })}
                            </select>
                        </td>
                        {<td>
                            <select id="size" name="size[]" className="custom-select ">
                                <option key='selectSize' value="">SELECT SIZE</option>
                                {sizes.map((size) => {
                                    return (
                                        <option key={size} value={size} >{size}</option>
                                    );
                                })}
                            </select>
                        </td>}
                        <td>
                            <input className="form-control"
                                type="number"
                                name="quantity_item[]"
                                id="quantity_item"
                                value="1"
                                placeholder="Quantity"
                            />
                        </td>
                        <td>
                            <input className="form-control"
                                type="number"
                                name="price_item[]"
                                id="price_item"
                                step='.01'
                                placeholder="Price"
                            />
                        </td>
                        <td>
                            {
                                <div className='btn btn-danger' onClick={removeItemsField}>Remove</div>}
                        </td>
                    </tr>
                </table>
            </div >);
        }
        return (<div>
            {rows}
        </div>);
    }

    return (
        <div>
            {displayAddItems()}
            <div className='btn btn-success float-right mx-2' onClick={addItemsField}>Add Item</div>
        </div>
    );
}

export default AddItem;
const element = document.getElementById("AddItem");
if (element) {
    let props = Object.assign({}, element.dataset);
    Object.keys(props).map(key => props[key] = JSON.parse(props[key]));
    ReactDOM.render(<AddItem {...props} />, element);
}
