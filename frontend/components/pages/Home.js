import React, {Component} from 'react';
import axios from 'axios';
import {
    NotificationManager,
    NotificationContainer
} from 'react-notifications';

const SORT_ASC = 0;
const SORT_DESC = 1;

export default class Home extends Component {

    constructor(props) {
        super(props);

        this.state = {
            tasks: null,
            sortOrder: SORT_DESC,
        }
    }

    componentDidMount() {
        axios.get('/api/tasks')
            .then(({data}) => {

                if (data.success) {
                    this.setState({tasks: data.tasks});
                    return;
                }

                NotificationManager.error('Cant load task list');
            });
    }

    sort(e) {
        let sortBy = e.target.getAttribute('data-field');
        let sortedTasks = this.state.tasks.slice().sort((first, second) => {
            if (this.state.sortOrder === SORT_DESC) {
                return first[sortBy] > second[sortBy] ? -1 : 1;
            }

            return first[sortBy] > second[sortBy] ? 1 : -1;
        });

        this.setState({
            tasks: sortedTasks,
            sortOrder: (this.state.sortOrder === SORT_DESC)
                ? SORT_ASC
                : SORT_DESC
        });
    }

    renderTaskList() {
        if (!this.state.tasks) {
            return <p>Loading...</p>;
        }

        if (Array.isArray(this.state.tasks) && !this.state.tasks.length) {
            return <p>No tasks yet</p>
        }

        return this.state.tasks.map((task, index) => {
            return (
                <div className="row task-list" key={index}>
                    <div className="col-3">{task.username}</div>
                    <div className="col-3">{task.email}</div>
                    <div className="col-3">{task.text}</div>
                    <div className="col-3">
                        <input
                            type="checkbox"
                            checked={task.completed_at !== null}
                            disabled="true"
                        />
                    </div>
                </div>
            );
        });
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-md-center">
                    <div className="col-8">
                        <div className="row">
                            <div className="col-11">
                                <h1>Tasks</h1>
                            </div>
                            <div className="col-1">
                                <a href="#/task/create" className="btn btn-success ">+</a>
                            </div>
                        </div>
                        <div className="row bg-info sortable" onClick={this.sort.bind(this)}>
                            <div className="col-3" data-field="username">Author</div>
                            <div className="col-3" data-field="email">Email</div>
                            <div className="col-3" data-field="text">Task text</div>
                            <div className="col-3" data-field="completed_at">Status</div>
                        </div>
                        {this.renderTaskList()}
                    </div>
                </div>
                <NotificationContainer/>
            </div>
        );
    }
}