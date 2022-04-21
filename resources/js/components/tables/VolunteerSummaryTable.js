import React, { Component } from 'react'
import Table from './Table'

class VolunteerSummaryTable extends Component {
  state = {
    columns: [
      { Header: 'Reading Events', accessor: 'readingEvents' },
      { Header: 'Most Common Student Age', accessor: 'studentAgeMode' },
      { Header: 'Most Common Student Location', accessor: 'studentLocationMode' }
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

export default VolunteerSummaryTable
