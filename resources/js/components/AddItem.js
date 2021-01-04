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
            rows.push(
                <div key={'item_' + i} className="border p-2 mt-5" id="dynamic_field">

                    <label htmlFor="material[]">Material</label>
                    <select id="material" name="material[]" className="custom-select ">
                        <option key='selectMaterial' value="">SELECT MATERIAL</option>
                        {materials.map((material) => {
                            return (
                                <option key={material + '_' + i} value={material}> {material}</option>
                            );
                        })}
                    </select>
            
                    <label htmlFor="size[]">Size</label>
                    <select id="size" name="size[]" className="custom-select ">
                        <option key='selectSize' value="">SELECT SIZE</option>
                        {sizes.map((size) => {
                            return (
                                <option key={size  + '_' + i} value={size} >{size}</option>
                            );
                        })}
                    </select>

                    <label htmlFor="quantity_item[]">Quantity</label>
                    <input className="form-control"
                        type="number"
                        name="quantity_item[]"
                        id="quantity_item"
                        min='1'
                        step="1"
                        placeholder="Quantity"
                    />

                    <label htmlFor="price_item[]">Price</label>
                    <input className="form-control"
                        type="number"
                        name="price_item[]"
                        id="price_item"
                        step='.01'
                        placeholder="Price"
                    />

                    <div className='btn btn-danger mt-2' onClick={removeItemsField}>Remove</div>
                </div>
            );
        }
        return (<div>
            {rows}
        </div>);
    }

    return (
        <div>
            {displayAddItems()}
            <div className='btn btn-success float-right mt-2' onClick={addItemsField}>Add Item</div>
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
