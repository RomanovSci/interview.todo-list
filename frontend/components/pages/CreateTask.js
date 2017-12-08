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
                    <div className="col-12 text-center">
                        <CreateTaskForm/>
                    </div>
                </div>
            </div>
        );
    }
}