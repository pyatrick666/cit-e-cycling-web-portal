<form action="edit_participant.php" method="POST">
    <div class="mb-3">
        <label class="form-label">Participant Firstname</label>
        <input type="text" class="form-control" disabled value="<?php echo htmlspecialchars($participant['firstname']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Participant Surname</label>
        <input type="text" class="form-control" disabled value="<?php echo htmlspecialchars($participant['surname']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Power output in watts</label>
        <input type="number" step="0.01" min="0" name="power_output" class="form-control" value="<?php echo htmlspecialchars((string)$participant['power_output']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Distance in KM</label>
        <input type="number" step="0.01" min="0" name="distance" class="form-control" value="<?php echo htmlspecialchars((string)$participant['distance']); ?>" required>
    </div>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($participant['id']); ?>">
    <button type="submit" class="btn btn-primary">Update this rider</button>
</form>
