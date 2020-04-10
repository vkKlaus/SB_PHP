<div>
    <h4 class="page-header">Создание разделов и подразделов</h4>
    <form action="" method="POST" class="form-create-section">

        <label class="enter-label" for="section">
            выберите раздел справа <br>
            или оставьте пустым для создания основного раздела
        </label>

        <input type="text" name="section" style="display:none" value="<?= $section ?>" id=" section">

        <div class="block-section">
            <div class="section-name"> <?= $sectionName ?></div>

            <a href="/route/sections/?clearSection=1" class="cross-clear">
                Х
            </a>
        </div>

        <label class="enter-label" for="sub-section">
            введите название нового раздела
        </label>
        <input type="text" name="subSection" required value="<?= $subSection ?>" id="sub-section">

        <label class="enter-label" for="color">
            выберите цвет отображения
        </label>
        <select size="1" name="color" id="color">
            <?php foreach ($colorsDB as $color) { ?>
                <option value="<?= $color['id'] ?>"><?= $color['name'] ?></option>
            <?php } ?>
        </select>

        <input type="submit" name="btnCreate" value="Создать" class="enter-button">
    </form>
</div>