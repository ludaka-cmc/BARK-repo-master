import React, { Component } from 'react'
import Table from './Table'

class VolunteerLogTable extends Component {
  state = {
    columns: [
      { Header: 'Name', accessor: 'name' },
      { Header: 'Date', accessor: 'date' },
      { Header: 'Location', accessor: 'location' },
      { Header: 'Number of Students', accessor: 'studentsTotal' },
      { Header: 'Age of Students', accessor: 'studentsAges' },
      {
        Header: 'Photo',
        accessor: 'photo',
        Cell: this.getPhotoCellComponent()
      }
    ]
  }

  getPhotoCellComponent () {
    return row => row.value
      ? (<a href={row.value} target='_blank'>Photo</a>)
      : 'n/a'
  }

  render () {
    const { columns } = this.state

    return (
      <Table columns={columns} {...this.props} />
    )
  }
}

export default VolunteerLogTable
