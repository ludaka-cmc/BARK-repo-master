import React, { Component } from 'react'
import Table from './Table'

class ReaderLogTable extends Component {
  state = {
    columns: [
      { Header: 'Name', accessor: 'name' },
      { Header: 'Date', accessor: 'date' },
      { Header: 'Location', accessor: 'location' },
      { Header: 'Dog', accessor: 'dog' },
      { Header: 'Book Read', accessor: 'bookRead' },
      { Header: 'Hours', accessor: 'hours' },
      { Header: 'Pages', accessor: 'pages' },
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

export default ReaderLogTable
