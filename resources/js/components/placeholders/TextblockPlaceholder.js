import React from 'react'
import ContentLoader from 'react-content-loader'

const TextblockPlaceholder = () => (
  <ContentLoader
    height='240'
    width='960'
  >
    <rect x='600' y='30' rx='4' ry='4' width='240' height='120' />

    <rect x='0' y='30' rx='4' ry='4' width='240' height='30' />
    <rect x='0' y='70' rx='4' ry='4' width='520' height='20' />
    <rect x='0' y='100' rx='4' ry='4' width='570' height='20' />
    <rect x='0' y='130' rx='4' ry='4' width='540' height='20' />
  </ContentLoader>
)

export default TextblockPlaceholder
