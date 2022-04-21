import React, { Component } from 'react'
import Table from './Table'

class ReaderSummaryTable extends Component {
  state = {
    columns: [
      { Header: 'Reading Events', accessor: 'readingEvents' },
      { Header: 'Books Read', accessor: 'booksRead' },
      { Header: 'Hours Read', accessor: 'hoursRead' },
      { Header: 'Pages Read', accessor: 'pagesRead' }
    ]
  }

  render () {
    const { columns } = this.state

    return (
      <Table
        columns={columns}
        showPagination={false}
        defaultPageSize={1}
        {...this.props}
      />
    )
  }
}

export default ReaderSummaryTable
