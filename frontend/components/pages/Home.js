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
            isLoggedIn: false,
            editing: false,
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

        axios.get(`/api/check-token?token=${localStorage.getItem('token')}`)
            .then(({data}) => {
                if (data.hasOwnProperty('success')) {
                    this.setState({
                        isLoggedIn: data.success,
                    })
                }
            });
    }

    /**
     * Sort tasks list
     * @param e
     */
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

    /**
     * Handle change input
     *
     * @param taskObject
     * @param field
     * @param e
     */
    handleInputChange(taskObject, field, e) {

        if (field === 'completed_at') {
            taskObject[field] = !taskObject[field];
        } else {
            taskObject[field] = e.target.value;
        }

        this.forceUpdate();
    }

    /**
     * Enable/disable editing
     * and send changes to server
     */
    toggleEditState() {

        /** Send data to server */
        if (this.state.editing) {
            axios.post('/api/tasks/update', {
                token: localStorage.getItem('token'),
                tasks: this.state.tasks,
            })
                .then(({data}) => {
                    console.log(data);
                });
        }

        this.setState({
            editing: !this.state.editing
        });
    }

    renderTaskList() {
        if (!this.state.tasks) {
            return <p>Loading...</p>;
        }

        if (Array.isArray(this.state.tasks) && !this.state.tasks.length) {
            return <p>No tasks yet</p>
        }

        return this.state.tasks.map(task => {
            return (
                <div className="row task-list" key={task.id}>
                    <div className="col-3">{task.username}</div>
                    <div className="col-3">{task.email}</div>
                    <div className="col-3">
                    {
                        (this.state.editing)
                            ? <input
                                type="text"
                                value={task.text}
                                className="form-control"
                                onChange={this.handleInputChange.bind(this, task, 'text')}
                              />
                            : task.text
                    }
                    </div>
                    <div className="col-1">
                        <input
                            className="form-check"
                            type="checkbox"
                            checked={!!task.completed_at}
                            onChange={this.handleInputChange.bind(this, task, 'completed_at')}
                            disabled={!this.state.editing}
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
                            <div className="col-8">
                                <h1>Tasks</h1>
                            </div>
                            <div className="col-1">
                                <a href="#/task/create" className="btn btn-success ">+</a>
                            </div>
                            { this.state.isLoggedIn
                                ? (<div className="col-3">
                                        <input
                                            type="button"
                                            className="btn btn-default"
                                            onClick={this.toggleEditState.bind(this)}
                                            value="Edit tasks"
                                        />
                                    </div>)
                                : null
                            }
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