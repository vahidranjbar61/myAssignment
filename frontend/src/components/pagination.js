
const Pagination = ({ currentPage, totalPages, handlePageChange }) => {
  const pageNumbers = [];
  for (let i = 1; i <= totalPages; i++) {
    pageNumbers.push(i);
  }

  return (
    <ul className="pagination">
      {pageNumbers.map((pageNumber) => (
        <a onClick={() => handlePageChange(pageNumber)} key={pageNumber} className={pageNumber === currentPage ? 'active' : ''}>
            {pageNumber}
        </a>
      ))}
    </ul>
  );
};

export default Pagination;
