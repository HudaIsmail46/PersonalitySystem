import React from 'react';

function NextOrderStates(props) {
    const { onClick, order } = props;
    
    const nextStates = (order) => {
        let states;
        switch(order.state) {
            case  "App\\State\\Order\\Draft":
                states = (
                    <div className='mb-1'>
                        <button
                        className="btn btn-success btn-block"
                        onClick={()=> onClick(order.id,  "App\\State\\Order\\PendingPickupSchedule")}
                        >
                            Pending Pickup Schedule
                        </button>
                        <button
                         className="btn btn-success btn-block"
                         onClick={()=> onClick(order.id,  "App\\State\\Order\\ReceivedWarehouse")}
                        >
                            Customer Drop Off In Warehouse
                        </button>
                    </div>
                )
                break;
            case  "App\\State\\Order\\PickupScheduled":
                states = (
                    <div className='mb-1'>
                        <button
                        className="btn btn-success btn-block"
                        onClick={()=> onClick(order.id,  "App\\State\\Order\\Collected")}
                        >
                            Collected
                        </button>
                        <button
                         className="btn btn-success btn-block"
                         onClick={()=> onClick(order.id,  "App\\State\\Order\\PendingPickupSchedule")}
                        >
                            Incomplete Pickup
                        </button>
                    </div>
                )
                break;
            case "App\\State\\Order\\Collected":
                states = (
                    <div
                        className="btn btn-success btn-block"
                        onClick={()=> onClick(order.id, "App\\State\\Order\\ReceivedWarehouse")}
                    >
                        Received Warehouse
                    </div>
                )
                break;
            case "App\\State\\Order\\ReceivedWarehouse":
                states = (
                    <div className='mb-1'>
                        <button
                            className="btn btn-success btn-block"
                            onClick={()=> onClick(order.id, "App\\State\\Order\\VendorCollected")}
                        >
                            Vendor Collected
                        </button>
                        <button
                            className="btn btn-success btn-block"
                            onClick={()=> onClick(order.id, "App\\State\\Order\\InHouseCleaning")}
                        >
                            InHouse Cleaning
                        </button>
                    </div>
                );
                break;
            case "App\\State\\Order\\VendorCollected":
                states = (
                    <div
                        className="btn btn-success btn-block"
                        onClick={()=> onClick(order.id, "App\\State\\Order\\PendingReturnSchedule")}
                    >
                        Cleaning Completed
                    </div>
                );
                break;
            case "App\\State\\Order\\InHouseCleaning":
                states = (
                    <div
                        className="btn btn-success btn-block"
                        onClick={()=> onClick(order.id, "App\\State\\Order\\PendingReturnSchedule")}
                    >
                        Cleaning Completed
                    </div>
                );
                break;
            case "App\\State\\Order\\PendingReturnSchedule":
                states = (
                    <div
                        className="btn btn-success btn-block"
                        onClick={()=> onClick(order.id, "App\\State\\Order\\Returned")}
                    >
                        Customer Self Collect
                    </div>
                );
                break;
            case "App\\State\\Order\\ReturnScheduled":
                states = (
                    <div className='mb-1'>
                        <button
                            className="btn btn-success btn-block"
                            onClick={()=> onClick(order.id,  "App\\State\\Order\\Returned")}
                        >
                            Returned To Customer
                        </button>
                        <button
                            className="btn btn-success btn-block"
                            onClick={()=> onClick(order.id,  "App\\State\\Order\\PendingReturnSchedule")}
                        >
                            Incomplete Return
                        </button>
                    </div>
                );
                break;
            case "App\\State\\Order\\Returned":
                states = (
                    <div className='mb-1'>
                        <div
                            className="btn btn-success btn-block"
                            onClick={()=> onClick(order.id, "App\\State\\Order\\Completed")}
                        >
                            Complete
                        </div>
                        <div
                            className="btn btn-success btn-block"
                            onClick={()=> onClick(order.id, "App\\State\\Order\\PendingPickupSchedule")}
                        >
                            Reprocessing
                        </div>
                    </div>
                );
                break;
            default:
                break;
        }

        return states;
    }

    return (
        <div>
            {nextStates(order)}
        </div>
    );
}

export default NextOrderStates;

