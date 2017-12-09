import React, {Component} from 'react';
import CreateTaskForm from './forms/CreateTaskForm';

export default class CreateTask extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-md-center">
                    <div className="col-4">
                        <CreateTaskForm/>
                    </div>
                </div>
            </div>
        );
    }
}